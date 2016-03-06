'use strict';

( function() {
	// Register a plugin named "summarybreak".
	CKEDITOR.plugins.add( 'summarybreak', {
		requires: 'fakeobjects',
		lang: 'af,ar,bg,bn,bs,ca,cs,cy,da,de,el,en,en-au,en-ca,en-gb,eo,es,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn', // %REMOVE_LINE_CORE%
		icons: 'summarybreak,summarybreak-rtl', // %REMOVE_LINE_CORE%
		hidpi: true, // %REMOVE_LINE_CORE%
		onLoad: function() {
			var cssStyles = (
					'background:url(' + CKEDITOR.getUrl( this.path + 'images/summary.gif' ) + ') no-repeat center center;' +
					'clear:both;' +
					'width:100%;' +
					'border-top:#999 1px dotted;' +
					'border-bottom:#999 1px dotted;' +
					'padding:0;' +
					'height:5px;' +
					'cursor:default;'
				).replace( /;/g, ' !important;' ); // Increase specificity to override other styles, e.g. block outline.

			// Add the style that renders our placeholder.
			CKEDITOR.addCss( 'div.cke_summarybreak{' + cssStyles + '}' );
		},

		init: function( editor ) {
			if ( editor.blockless )
				return;

			// Register the command.
			editor.addCommand( 'summarybreak', CKEDITOR.plugins.summarybreakCmd );

			// Register the toolbar button.
			editor.ui.addButton && editor.ui.addButton( 'SummaryBreak', {
				label: 'Phân cách phần tóm tắt (Summary)',
				command: 'summarybreak',
				toolbar: 'insert,70'
			} );

			// Webkit based browsers needs help to select the summary-break.
			CKEDITOR.env.webkit && editor.on( 'contentDom', function() {
				editor.document.on( 'click', function( evt ) {
					var target = evt.data.getTarget();
					if ( target.is( 'div' ) && target.hasClass( 'cke_summarybreak' ) )
						editor.getSelection().selectElement( target );
				} );
			} );
		},	
		
		afterInit: function( editor ) {
			// Register a filter to displaying placeholders after mode change.
			var dataProcessor = editor.dataProcessor,
				dataFilter = dataProcessor && dataProcessor.dataFilter,
				htmlFilter = dataProcessor && dataProcessor.htmlFilter,
				styleRegex = /summary-break\s*:\s*true/i,
				childStyleRegex = /border-radius\s*:\s*0px/i;

			function upcastPageBreak( element ) {
				CKEDITOR.tools.extend( element.attributes, attributesSet( 'Summary Break' ), true );

				element.children.length = 0;
			}

			if ( htmlFilter ) {
				htmlFilter.addRules( {
					attributes: {
						'class': function( value, element ) {
							var className = value.replace( 'cke_summarybreak', '' );
							if ( className != value ) {
								var span = CKEDITOR.htmlParser.fragment.fromHtml( '<span style="border-radius:0px">&nbsp;</span>' ).children[ 0 ];
								element.children.length = 0;
								element.add( span );
								var attrs = element.attributes;
								delete attrs[ 'aria-label' ];
								delete attrs.contenteditable;
								delete attrs.title;
							}
							return className;
						}
					}
				}, { applyToAll: true, priority: 5 } );
			}

			if ( dataFilter ) {
				dataFilter.addRules( {
					elements: {
						div: function( element ) {
							// The "internal form" of a pagebreak is pasted from clipboard.
							// ACF may have distorted the HTML because "internal form" is
							// different than "data form". Make sure that element remains valid
							// by re-upcasting it (#11133).
							if ( element.attributes[ 'data-cke-summarybreak' ] )
								upcastPageBreak( element );

							// Check for "data form" of the pagebreak. If both element and
							// descendants match, convert them to internal form.
							// convert tu html row to design
							else if ( styleRegex.test( element.attributes.style ) ) {
								//var child = element.children[ 0 ];
								//if ( child && child.name == 'span' && childStyleRegex.test( child.attributes.style ) ) {
								//	alert('update ui');
								//	upcastPageBreak( element );
								//}
								upcastPageBreak( element );
							}
						}
					}
				} );
			}
		}
	} );

	// TODO Much probably there's no need to expose this object as public object.
	CKEDITOR.plugins.summarybreakCmd = {
		exec: function( editor ) {
			// Create read-only element that represents a print break.
			var summarybreak = editor.document.createElement( 'div', {
				attributes: attributesSet( 'Summary Break' )
			} );
			editor.insertElement( summarybreak );
		},
	};

	// Returns an object representing all the attributes
	// of the "internal form" of the summarybreak element.
	function attributesSet( label ) {
		return {
			'aria-label': label,
			'class': 'cke_summarybreak',
			contenteditable: 'false',
			'data-cke-display-name': 'summarybreak',
			'data-cke-summarybreak': 1,
			style: 'summary-break: true',
			title: label
		};
	}
} )();