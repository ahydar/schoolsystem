<template>
    <div>
        <!-- textarea -->
        <div class="form-group">
            <label>{{title}} <span v-if="required" style="color:red;">*</span></label>
            <textarea class="form-control" rows="3" :name="field" v-model="form[field]" placeholder="Enter ..."></textarea>
            <span style="color:red;" v-text="form.errors.get(field)"></span>
        </div>
    </div>

    
</template>

<script>
export default {
  props:['title','field',"form","required"]
}
</script>