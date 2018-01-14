<template>
    <div class="form-group">
        <label>{{title}} <span v-if="required" style="color:red;">*</span></label>
         <select class="form-control" :id="field" :name='field' v-model="form[field]">
        <option v-for="item in items" v-bind:value="item[names.value]">
            {{ item[names.display] }}
        </option>
        </select>
        <span style="color:red;" v-text="form.errors.get(field)"></span>
    </div>
</template>

<script>
export default {
  props:['title','field',"form","items","names","required"],
  mounted(){
      //$('#'+this.field).selectpicker('val',this.form[this.field]);
  }
}
</script>