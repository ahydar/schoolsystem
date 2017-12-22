<template>
  <div>
    <modal :modalID="modalID">
      <div slot="header"><h3>Delete - {{name}}</h3></div>
      <div slot="body">
            {{message}}
      </div>
      <div slot="footer">
        <button type="button"  v-bind:class="[btnActive]" @click="confirm()">Yes</button>
        <button type="button"  class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </modal>
  </div>
</template>

<script>
    export default {
      props:['message','btnClass','modalID','name'],
      data(){
        return{

        }
      },
      computed:{
            btnActive: function(){
                if(this.btnClass === 'danger'){
                  return 'btn btn-danger';
                }else{
                  return 'btn btn-primary';
                }
            }
      },
      methods:{
          confirm(){
              this.$emit('confirmed');
          }
      }
    }
</script>
