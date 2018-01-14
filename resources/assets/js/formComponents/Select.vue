<template>
    <div class="form-group">
        <label>{{title}} <span v-if="required" style="color:red;">*</span></label>
         <select class="form-control selectpicker" :id="field" :name='field' v-model="form[field]" :title="title">
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
      $('#'+this.field).selectpicker('val',this.form[this.field]);
      /*console.log("Form Select");
      console.log(this.form);
      console.log(this.field);
      console.log("-----------------");
      console.log(this.form[this.field]);
      console.log("-----------------");*/
  }
}
</script>