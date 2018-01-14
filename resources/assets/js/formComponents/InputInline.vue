<template>
    <div class="form-group">
        <label class="control-label col-sm-2" for="firstName">
            <span class="pull-left">{{title}} <span v-if="required" style="color:red;">*</span></span></label>
        <div class="col-sm-8">
            <input :type="type" class="form-control" id="firstName" :name="field" placeholder="Enter Name" v-model="form[field]">
            <span style="color:red;" v-text="form.errors.get(field)"></span>
        </div>
    </div>
</template>

<script>
export default {
  props:['title','field',"form","type","required"]
}
</script>
