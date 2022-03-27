/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */
function setDateZero(date){
  return date < 10 ? '0' + date : date;
}
var d = new Date();
var tahun = d.getFullYear();
var curr_month = d.getMonth()+1;
var bulan = setDateZero(curr_month);
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'document',	   groups: [ 'mode'] },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		//{ name: 'forms' },
		//{ name: 'tools' },
		{ name: 'others' },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'flash' ] },
		{ name: 'styles' },
		{ name: 'colors' }
		//{ name: 'about' }
	];
	config.extraPlugins = 'youtube';
	config.filebrowserBrowseUrl = '../kcfinder/browse.php?type=files&dir=files';
	config.filebrowserImageBrowseUrl = '../kcfinder/browse.php?type=images&dir=images/post/'+tahun+'/'+bulan;
	config.filebrowserFlashBrowseUrl = '../kcfinder/browse.php?type=flash&dir=flash';
	//Remove some buttons, provided by the standard plugins, which we don't
	//need to have in the Standard(s) toolbar. codemirror
	config.removeButtons = 'Underline,Subscript,Superscript';

};
