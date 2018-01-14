<template>
    <div class="form-group">
        <label>{{title}} <span v-if="required" style="color:red;">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" :name="field" v-model="form[field]" id="datepicker">
            <span style="color:red;" v-text="form.errors.get(field)"></span>
        </div>
        <!-- /.input group -->
    </div>
</template>

<script>
export default {
  props:['title','field',"form","type","required"],
  mounted(){
        $('#datepicker').datepicker({
            autoclose: true
        });
        $("#datepicker").datepicker("setDate", this.form[this.field]);
  }
}
</script>