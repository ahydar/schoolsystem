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
       educator: {
         type: Boolean,
         required: false // User can accept a userData object on params, or not. It's totally optional.
       }
    },
    data(){
      return {
        formsubject_id:0,
        link:'',
        subjects:[]
      }
    },
    mounted(){
        if(this.educator){
            this.link = '/listcomponents/subjects/educator';
        }else{
            this.link ='/listcomponents/subjects';
        }
        var self = this;
        axios.get(this.link).then(function(result){
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
