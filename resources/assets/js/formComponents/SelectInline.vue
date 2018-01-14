<template>
    <div class="form-group">
      <label class="control-label col-sm-2" for="form_id">
        <span class="pull-left">{{title}} <span v-if="required" style="color:red;">*</span></span></label>
      <div class="col-sm-8">
        <select class="form-control" name='form_id' v-model="form[field]" :title="title">
          <option v-for="item in items" v-bind:value="item[names.value]">
            {{ item[names.display] }}
          </option>
        </select>
        <span style="color:red;" v-text="form.errors.get(field)"></span>
      </div>
    </div>
</template>

<script>
export default {
  props:['title','field',"form","items","names","required"]
}
</script>