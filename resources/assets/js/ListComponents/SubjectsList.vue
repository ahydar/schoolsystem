<template>
    <div>
        <select class="form-control" name='grade_id' v-model="formsubject_id" @change="announce()">
            <option v-for="subject in subjects" v-bind:value="subject.id">
                {{ subject.subjectName }} {{ subject.formName }}
            </option>
        </select>
    </div>
</template>
<script>
  export default {
    props:{
       learner: {
         type: Object,
         required: false // User can accept a userData object on params, or not. It's totally optional.
       }
    },
    data(){
      return {
        formsubject_id:0,
        subjects:[]
      }
    },
    mounted(){
        var self = this;
        axios.get('/listcomponents/subjects').then(function(result){
               self.subjects = result.data; 
                //$('.selectpicker').selectpicker();
        });
    },
    methods:{
        announce:function(){
            console.log("Announce : "+this.formsubject_id);
            this.$emit('announce',this.formsubject_id);
          
        }
    }
  }
</script>
