<?php
/*
 *  By:Orange-W
 *  自定义数据表
*/
namespace Home\Model;
use Think\Model;

class DataformModel extends Model {
	protected $autoCheckFields =false;

	private $table;
	private $description;
	private $mainKey;
	private $tableData;
	private $produceData;
	private $colField;
    private $colName = '';
	private $colModel="{name:'table',index:'table', width:80, fixed:true, sortable:false, resize:false,
							formatter:'actions',
							formatoptions:{
								keys:true,

								//delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback},
								//editformbutton:true, editOptions:{recreateForm: true, beforeShowForm:beforeEditCallback}
							}
						}";

	public function __construct($table,$des='',$mainKey='id'){
		$this->table = $table;
		$this->description = $des;
		$this->mainKey = $mainKey;
	}

    public function setTableData($tableData){
        $this->tableData = $tableData;
		$this->produceData();
        return $this;
    }

	private function produceData(){
		$add='';
		foreach($this->tableData as $key => $data){
			//print_r($this->colField);
			$add .= "{table:'$this->table'";
			foreach($this->colField as $key2 => $field)
			{
				$tmp = $data[$field];
				$add .= " ,$field:'$tmp' ";
			}
			$add .= "},";

		}

		$this->produceData = $add;

		return $this;
	}

    /**
     * @param array $col
     * @For  设置表头的字段
     * @return $this
     */
    public function  setCol($col=array()){
		$this->colField=$col;
        $add='';
        foreach($col as $k => $v){
            $add .= ", '$v'";
        }
        $this->colName="[''$add]";
        return $this;
    }

	public function addSelfColModel($add){
        $this->colModel .= ','.$add;
        return $this;
    }

	public function addModelId($name='id',$width=90,$editable='false',$sorttype='int'){
        $this->colModel .= ",
						{name:'$name',index:'$name', width:$width, sorttype:'$sorttype',sortname:'id', editable: $editable}";
        return $this;
    }

	public function addModelDate($name='date',$width=90,$editable='true',$sorttype='date'){
        $this->colModel .= ",
						{name:'$name',index:'$name',width:$width, editable:$editable, sorttype:'$sorttype',unformat: pickDate}";
        return $this;
    }

	public function addModelFontdata($name='font',$width=90,$editable='true',$fontSize='20',$maxlength='30'){
        $this->colModel .= ",
						{name:'$name',index:'$name', width:$width,editable: $editable,editoptions:{size:'$fontSize',maxlength:'$maxlength'}}";
        return $this;
    }

	public function addModelCheckbox($name='checkbox',$width=70,$editable='true',$editoptions='1:0'){
        $this->colModel .= ",
           {name:'$name',index:'$name', width:$width, editable: $editable,edittype:'checkbox',editoptions: {value:'$editoptions'},unformat: aceSwitch}";
        return $this;
    }

	public function addModelSelect($name='select',$width=90,$editable='true',$selectValue='value1:show1;value2:2'){
        $this->colModel .= ",
          {name:'$name',index:'$name', width:$width, editable: $editable,edittype:'select',editoptions:{value:'$selectValue'}}";
        return $this;
    }

	public function addModelFile($name='file',$width=150,$editable='true'){
        $this->colModel .= ",
            {name:'$name',index:'$name', width:$width, sortable:false,editable: $editable,edittype:'file', editoptions:{rows:'2',cols:'10'}}";
        return $this;
    }

	public function addModelTextarea($name='textarea',$width=90,$editable='true',$rows=2,$cols=10){
        $this->colModel .= ",
            {name:'$name',index:'$name', width:$width, sortable:false,editable: $editable,edittype:'textarea', editoptions:{rows:'$rows',cols:'$cols'}}";
        return $this;
    }

	public function  buildForm($url){
		$colNae = $this->colName;
        $editUrl=U($url);
        $data=<<<Eot
        <script type="text/javascript">
			var grid_data =
			[
				$this->produceData
			];

			jQuery(function($) {
				var grid_selector = "#grid-table";
				var pager_selector = "#grid-pager";

				jQuery(grid_selector).jqGrid({
					//direction: "rtl",

					mtype: 'POST',
					data: grid_data,
					datatype: "local",
					height: 400,
					colNames:$colNae,
					colModel:[
						$this->colModel
					],

					sortname:'$this->mainKey',
					viewrecords : true,
					rowNum:10,
					rowList:[10,30,50],
					pager : pager_selector,
					altRows: true,
					//toppager: true,

					multiselect: true,
					//multikey: "ctrlKey",
			        multiboxonly: true,

					loadComplete : function() {
            var table = this;
            setTimeout(function(){
                styleCheckbox(table);

                updateActionIcons(table);
                updatePagerIcons(table);
                enableTooltips(table);
            }, 0);
        },
					postData: '$this->table',
					editurl: "$editUrl",
					caption: "$this->description",


					autowidth: true

				});

				//enable search/filter toolbar
				//jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})

				//switch element when editing inline
				function aceSwitch( cellvalue, options, cell ) {
                    setTimeout(function(){
                        $(cell) .find('input[type=checkbox]')
                        .wrap('<label class="inline" />')
                        .addClass('ace ace-switch ace-switch-5')
                        .after('<span class="lbl"></span>');
                    }, 0);
                }
				//enable datepicker
				function pickDate( cellvalue, options, cell ) {
                    setTimeout(function(){
                        $(cell) .find('input[type=text]')
                        .datepicker({format:'yyyy-mm-dd' , autoclose:true});
					}, 0);
                }


				//navButtons
				jQuery(grid_selector).jqGrid('navGrid',pager_selector,
					{ 	//navbar options
						edit: true,
						editicon : 'icon-pencil blue',
						add: true,
						addicon : 'icon-plus-sign purple',
						del: true,
						delicon : 'icon-trash red',
						search: true,
						searchicon : 'icon-search orange',
						refresh: true,
						refreshicon : 'icon-refresh green',
						view: true,
						viewicon : 'icon-zoom-in grey',
					},
					{
                        //edit record form
                        //closeAfterEdit: true,

                        recreateForm: true,
						beforeShowForm : function(e) {
                        var form = $(e[0]);
							form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
							style_edit_form(form);
						}
					},
					{
                        //new record form
                        closeAfterAdd: true,
						recreateForm: true,
						viewPagerButtons: false,
						beforeShowForm : function(e) {
                        var form = $(e[0]);
							form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
							style_edit_form(form);
						}
					},
					{
                        //delete record form
                        recreateForm: true,
						beforeShowForm : function(e) {
                        var form = $(e[0]);
							if(form.data('styled')) return false;

							form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
							style_delete_form(form);

							form.data('styled', true);
						},
						onClick : function(e) {
                        alert(1);
                    }
					},
					{
                        //search form
                        recreateForm: true,
						afterShowSearch: function(e){
                        var form = $(e[0]);
							form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
							style_search_form(form);
						},
						afterRedraw: function(){
                        style_search_filters($(this));
                    }
						,
						multipleSearch: true,
						/**
                        multipleGroup:true,
                        showQuery: true
                         */
					},
					{
                        //view record form
                        recreateForm: true,
						beforeShowForm: function(e){
                        var form = $(e[0]);
							form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
						}
					}
				)



				function style_edit_form(form) {
                    //enable datepicker on "sdate" field and switches for "stock" field
                    form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})
						.end().find('input[name=stock]')
                    .addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');

					//update buttons classes
					var buttons = form.next().find('.EditButton .fm-button');
					buttons.addClass('btn btn-sm').find('[class*="-icon"]').remove();//ui-icon, s-icon
					buttons.eq(0).addClass('btn-primary').prepend('<i class="icon-ok"></i>');
					buttons.eq(1).prepend('<i class="icon-remove"></i>')

					buttons = form.next().find('.navButton a');
					buttons.find('.ui-icon').remove();
					buttons.eq(0).append('<i class="icon-chevron-left"></i>');
					buttons.eq(1).append('<i class="icon-chevron-right"></i>');
				}

				function style_delete_form(form) {
                    var buttons = form.next().find('.EditButton .fm-button');
                    buttons.addClass('btn btn-sm').find('[class*="-icon"]').remove();//ui-icon, s-icon
                    buttons.eq(0).addClass('btn-danger').prepend('<i class="icon-trash"></i>');
                    buttons.eq(1).prepend('<i class="icon-remove"></i>')
				}

				function style_search_filters(form) {
                    form.find('.delete-rule').val('X');
                    form.find('.add-rule').addClass('btn btn-xs btn-primary');
                    form.find('.add-group').addClass('btn btn-xs btn-success');
                    form.find('.delete-group').addClass('btn btn-xs btn-danger');
                }
				function style_search_form(form) {
                    var dialog = form.closest('.ui-jqdialog');
                    var buttons = dialog.find('.EditTable')
					buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'icon-retweet');
					buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'icon-comment-alt');
					buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'icon-search');
				}

				function beforeDeleteCallback(e) {
                    var form = $(e[0]);
					if(form.data('styled')) return false;

					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
					style_delete_form(form);

					form.data('styled', true);
				}

				function beforeEditCallback(e) {
                    var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
					style_edit_form(form);
				}



				//it causes some flicker when reloading or navigating grid
				//it may be possible to have some custom formatter to do this as the grid is being created to prevent this
				//or go back to default browser checkbox styles for the grid
				function styleCheckbox(table) {
                    /**
                    $(table).find('input:checkbox').addClass('ace')
                    .wrap('<label />')
                    .after('<span class="lbl align-top" />')


                    $('.ui-jqgrid-labels th[id*="_cb"]:first-child')
                    .find('input.cbox[type=checkbox]').addClass('ace')
                    .wrap('<label />').after('<span class="lbl align-top" />');
                     */
                }


				//unlike navButtons icons, action icons in rows seem to be hard-coded
				//you can change them like this in here if you want
				function updateActionIcons(table) {
                    /**
                    var replacement =
                    {
                    'ui-icon-pencil' : 'icon-pencil blue',
                    'ui-icon-trash' : 'icon-trash red',
                    'ui-icon-disk' : 'icon-ok green',
                    'ui-icon-cancel' : 'icon-remove red'
                    };
                    $(table).find('.ui-pg-div span.ui-icon').each(function(){
                    var icon = $(this);
                    var myClass = $.trim(icon.attr('class').replace('ui-icon', ''));
						if(myClass in replacement) icon.attr('class', 'ui-icon '+replacement[myClass]);
					})
					*/
				}

				//replace icons with FontAwesome icons like above
				function updatePagerIcons(table) {
					var replacement =
					{
						'ui-icon-seek-first' : 'icon-double-angle-left bigger-140',
						'ui-icon-seek-prev' : 'icon-angle-left bigger-140',
						'ui-icon-seek-next' : 'icon-angle-right bigger-140',
						'ui-icon-seek-end' : 'icon-double-angle-right bigger-140'
					};
					$('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
						var icon = $(this);
						var myClass = $.trim(icon.attr('class').replace('ui-icon', ''));

						if(myClass in replacement) icon.attr('class', 'ui-icon '+replacement[myClass]);
					})
				}

				function enableTooltips(table) {
                    $('.navtable .ui-pg-button').tooltip({container:'body'});
					$(table).find('.ui-pg-div').tooltip({container:'body'});
				}

				//var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');


			});
        </script>
Eot;
        return $data;
    }


}