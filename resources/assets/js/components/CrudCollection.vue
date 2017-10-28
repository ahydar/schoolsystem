<template>

</template>

<script>
import {dataTableLoad,destroyDataTable} from '../services/ajaxService';
export default {
  data(){
    return{
      name:"Random",
      action:"",
      items:[],
      editing:false,
      modal_id:'myModal',
      deleteModalId : 'delete',
      deleteItem : {}
    }
  },
  mounted(){
    var self = this;
    axios.get(this.url).then(function(result){
            self.createTable(result.data);
    });
  },
  methods:{
    createTable:function(data){
      console.log('****CRUD Collection****');
      this.items = data;
      dataTableLoad(this.table);
    },
    formAction:function(action,data = ""){
        if(action === "add"){
            this.action = "New Grade";
            this.editing = false;
            this.form.reset();
        }else{
            this.form.edit(data);
            this.action = "Update Grade";
            this.editing = true;
        }
        $("#"+this.modal_id).modal('show');
    },
    save:function(){
          if(this.editing){
            this.edit();
          }else{
            this.add();
          }
    },
    submit(type,url,notify,title,message,modalId){
      var self = this;
      destroyDataTable(self.table);

      this.form.submit(type,url).then(response => {
        console.log(response);
        self.createTable(response);
        $("#"+modalId).modal('hide');
        this.$notify({
          title: title,
          type: notify,
          text: message
        });
      })

      .catch(error => console.log('something went wrong'));
    },
    add(){
      this.submit('post',this.url,'success','Saved','Grade has been created',this.modal_id);
    },
    edit(){
      var id = this.form.id;
      this.submit('patch',this.url+'/'+id,'success','Updated','Grade has been updated',this.modal_id);
    },
    removeCheck(data){
        $("#"+this.deleteModalId).modal('show');
        this.deleteItem = data;
    },
    remove(){
      var id = this.deleteItem.id;
      this.submit('delete',this.url+'/'+id,'error','Removed','Grade has been removed',this.deleteModalId);
    }
  }
}
</script>
