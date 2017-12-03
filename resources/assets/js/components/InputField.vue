<template>
  <div class="form-group">
    <label class="control-label col-sm-2" :for="id"><span class="pull-left">{{label}}:</span></label>
    <div class="col-sm-8">
      <input :type="type" class="form-control" :id="id" :placeholder="placeholder" v-model="modelValue" v-on:blur="updateForm">
    </div>
  </div>
</template>

<script>
    export default {
      props:['id','label','type','placeholder','value'],
      data(){
        return{
          modelValue:this.value
        }
      },
      methods:{
        updateForm:function(){
          this.$emit('updateForm',this.id,this.modelValue)
        }
      }
    }
</script>
