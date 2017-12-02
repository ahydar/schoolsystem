<template>
  <div class="form-group">
    <label class="control-label col-sm-2" :for="id"><span class="pull-left">{{label}}:</span></label>
    <div class="col-sm-10">
      <input :type="type" class="form-control" :id="id" :placeholder="placeholder">
    </div>
  </div>
</template>

<script>
    export default {
      props:['id','label','type','placeholder']
    }
</script>
