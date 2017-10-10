//server call loading

//Datatable initializer
export var dataTableLoad = function(tableID){
    $(document).ready(function(){
        var table = $('#'+tableID).DataTable({
            responsive: true
        });
    });
};

export var destroyDataTable = function(tableID){
  if($('#'+tableID).DataTable()){
    $('#'+tableID).DataTable().destroy();
  }
}
