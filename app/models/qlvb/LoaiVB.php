<?php

class LoaiVB extends Eloquent {
	protected $table = 'web_qlvb_loaivanban';
	protected $primaryKey = 'id';

	public $timestamps = false;

    public static function update_all_loaivb_info() {
        $tablename = with(new LoaiVB())->getTable();

        $top_items = DB::table($tablename)->get();
        foreach ( $top_items as $item ) {
            $child_items = LoaiVB::get_loaivb($item->id);
            if ( $child_items && count($child_items) > 1 ) {
                # [0] = $item->id ==> remove [0]
                unset($child_items[0]);
                DB::update("update ".$tablename." set childs='".implode(',', $child_items)."' where id=".$item->id);
            }
        }
    }

    /**
     * Lấy loại VB con của một loại VB
     *
     * @param $parent_loaivb_id
     *
     * @return array (id của các loại VB - bao gồm $parent_loaivb_id
     */
    public static function get_loaivb($parent_loaivb_id) {
        $tablename = with(new LoaiVB())->getTable();

        $list = array();
        array_push($list, $parent_loaivb_id);

        $childs = DB::table($tablename)
            ->where('parent_id', '=', $parent_loaivb_id)
            ->get();
        if ( $childs && count($childs) > 0 ) {
            foreach ( $childs as $child ) {
                # de qui lay danh sach con
                LoaiVB::get_loaivb_sub($child->id, $tablename, $list);
            }
        }

        return $list;
    }

    /**
     * Đệ qui cho hàm get_loaivb
     *
     * @param $loaivb_id
     * @param $tablename
     * @param $result
     */
    private static function get_loaivb_sub($loaivb_id, $tablename, &$result) {
        array_push($result, $loaivb_id);

        $childs = DB::table($tablename)
            ->where('parent_id', '=', $loaivb_id)
            ->get();
        if ( $childs && count($childs) > 0 ) {
            # de qui lay danh sach con
            foreach ( $childs as $child ) {
                LoaiVB::get_loaivb_sub($child->id, $tablename, $result);
            }
        }
    }

    /**
     * Lấy cấu trúc dạng cây (tree) của tất cả loại VB
     *
     * @param int $loaivb_id
     *
     * @return array
     */
    public static function list_all($loaivb_id = 0) {
        $tablename = with(new LoaiVB())->getTable();
        $list_loaivb = DB::table($tablename)
            ->where(DB::Raw('IFNULL(parent_id,0)'), '=', 0);
        if ( $loaivb_id > 0 ) {
            $list_loaivb = $list_loaivb->where('id', '=', $loaivb_id);
        }
        $list_loaivb = $list_loaivb->get();

        $result = array();

        $tree_level = 0;
        foreach ( $list_loaivb as $loaivb ) {
            // gan treelevel do cho loaivb
            $loaivb->level = $tree_level;

            // them vao danh sach loaivb
            array_push($result, $loaivb);

            // quét loaivb con
            LoaiVB::list_all_sub($loaivb, $tablename, $result, $tree_level);
        }

        return $result;
    }

    /**
     * Để qui cho hàm list_all
     *
     * @param $parent_info
     * @param $tablename
     * @param $result
     * @param $tree_level
     */
    private static function list_all_sub($parent_info, $tablename, &$result, &$tree_level) {
        $list = DB::table($tablename)
            ->where('parent_id', '=', $parent_info->id)
            ->get();

        $parent_info->child_count = count($list);
        $tree_level++;

        foreach ( $list as $item ) {
            $item->level = $tree_level;

            array_push($result, $item);

            LoaiVB::list_all_sub($item, $tablename, $result, $tree_level);
        }

        $tree_level--;
    }

    /**
     * Lấy danh sách loại VB (dùng để hiển thị trong combobox)
     *
     * @param int $loaivb_id
     *
     * @return string
     */
    public static function list_loaivb_combobox($loaivb_id = 0) {
        $tablename = with(new LoaiVB())->getTable();

        $list_loaivb = null;
        if ( $loaivb_id == 0 ) {
            # get all cats
            $list_loaivb = DB::select('select * from '.$tablename.' where IFNULL(parent_id,0)=0 order by orderno');
        }
        else {
            $list_loaivb = DB::select('select * from '.$tablename.' where id = ?', array($loaivb_id));
        }

        $html = '';
        $tree_level = 0;
        foreach ( $list_loaivb as $loaivb ) {
            $html .= '<option value="'.$loaivb->id.'">'.$loaivb->tenloaivb.'</option>';

            LoaiVB::list_loaivb_combobox_sub($loaivb->id, $html, $tree_level, $tablename);
        }

        return $html;
    }

    /**
     * Đệ qui cho hàm list_loaivb_combobox
     *
     * @param $parent_cat_id
     * @param $html
     * @param $tree_level
     * @param $tablename
     */
    private static function list_loaivb_combobox_sub($parent_cat_id, &$html, &$tree_level, $tablename) {
        if ( !$parent_cat_id ) $parent_cat_id = 0;

        $sub_cats = DB::select('select * from '.$tablename.' where IFNULL(parent_id,0) = '.$parent_cat_id.' order by orderno');

        $tree_level++;
        $padding_str = '';
        for ( $i=0; $i<$tree_level; $i++ ) {
            $padding_str .= '|' . str_repeat('-',4);
        }

        foreach ( $sub_cats as $sub_cat ) {
            $html .= '<option value="'.$sub_cat->id.'">'.$padding_str . $sub_cat->tenloaivb.'</option>';
            LoaiVB::list_loaivb_combobox_sub($sub_cat->id, $html, $tree_level, $tablename);
        }
        $tree_level--;
    }

    /**
     * Xóa 1 loại VB ( xóa lưu các VB liên quan+các loại VB con)
     *
     * @param $loaivb_id
     *
     * @return bool
     */
    public static function delete_loaivb($loaivb_id) {
        $tablename = with(new LoaiVB())->getTable();
        $vb_table = with(new VanBan())->getTable();

        $loaivbinfo = LoaiVB::find($loaivb_id);

        $list_vb_deleted = array();
        $list_loaivb_deleted = array();

        if ( $loaivbinfo ) {
            // xoa cac vb thuoc loai vb
            $list_vanban = DB::table($vb_table)
                ->where('loaivb_id','=',$loaivb_id)
                ->get();
            foreach ( $list_vanban as $vb ) array_push($list_vb_deleted, $vb);

            LoaiVB::delete_loaivb_sub($loaivbinfo->id, $tablename, $list_vb_deleted, $list_loaivb_deleted);
            array_push($list_loaivb_deleted, $loaivbinfo);

            # tien hanh xoa
            DB::beginTransaction();
            foreach ( $list_vb_deleted as $vb ) {
                if ( !VanBan::delete_vanban_n_files($vb->id) ) {
                    DB::rollback();
                    return false;
                }
            }
            foreach ( $list_loaivb_deleted as $lvb ) {
                if ( !DB::delete('delete from '.$tablename.' where id='.$lvb->id) ) {
                    DB::rollback();
                    return false;
                }
            }
            DB::commit();
            return true;
        }
        else return false;
    }

    /**
     * Đệ qui cho hàm delete_loaivb
     *
     * @param $parent_cat_id
     * @param $tablename
     * @param $list_vb_deleted
     * @param $list_loaivb_deleted
     */
    private static function delete_loaivb_sub($parent_cat_id, $tablename, &$list_vb_deleted, &$list_loaivb_deleted) {
        $vb_table = with(new VanBan())->getTable();
        $sub_cats = LoaiVB::where('parent_id', '=', $parent_cat_id)->get();
        foreach ( $sub_cats as $sub_cat ) {
            // xoa cac vb thuoc loai vb
            $list_vanban = DB::table($vb_table)
                ->where('loaivb_id','=',$sub_cat->id)
                ->get();
            foreach ( $list_vanban as $vb ) array_push($list_vb_deleted, $vb);

            LoaiVB::delete_loaivb_sub($sub_cat->id, $tablename, $list_vb_deleted, $list_loaivb_deleted);
            array_push($list_loaivb_deleted, $sub_cat);
        }
    }
}