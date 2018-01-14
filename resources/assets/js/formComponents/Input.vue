<template>
    <div class="form-group">
        <label>{{title}} <span v-if="required" style="color:red;">*</span></label>
        <input type="text" class="form-control" placeholder="Enter ..." :name="field" v-model="form[field]">
        <span style="color:red;" v-text="form.errors.get(field)"></span>
    </div>
</template>

<script>
export default {
  props:['title','field',"form","type","required"]
}
</script>