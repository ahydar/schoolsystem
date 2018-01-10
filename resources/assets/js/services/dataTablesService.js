//server call loading

//Datatable initializer
export var dataTableLoad = function(tableID){
    $(document).ready(function(){
        var table = $('#'+tableID).DataTable({
            'responsive': true,
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
        });
    });
};

export var destroyDataTable = function(tableID){
  if($('#'+tableID).DataTable()){
    $('#'+tableID).DataTable().destroy();
  }
}
