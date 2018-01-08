<template>
    <div>
        <select class="form-control" name='grade_id' v-model="form_id" @change="announce()">
            <option v-for="form in forms" v-bind:value="form.id">
                {{ form.formName }}
            </option>
        </select>
    </div>
</template>
<script>
  export default {
    props:{
       educator: {
         type: String,
         required: false // User can accept a userData object on params, or not. It's totally optional.
       }
    },
    data(){
      return {
        form_id:0,
        link:'',
        forms:[]
      }
    },
    mounted(){
        if(this.educator){
            this.link = '/listcomponents/forms/educator';
        }else{
            this.link ='/listcomponents/forms';
        }
        var self = this;
        axios.get(this.link).then(function(result){
               self.forms = result.data; 
        });
    },
    methods:{
        announce:function(){
            console.log("Announce : "+this.form_id);
            this.$emit('announce',this.form_id);
          
        }
    }
  }
</script>
