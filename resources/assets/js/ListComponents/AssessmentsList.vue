<template>
    <div>

        <select class="form-control"   v-if="assessments.length > 0" v-model="assess_id" @change="announce()">
            <option v-for="assessment in assessments" v-bind:value="assessment.id">
                {{ assessment.assessName }}
            </option>
        </select>

        <span v-if="assessments.length === 0">No Assessments asigned to this subject</span>
    </div>
</template>
<script>
  export default {
    props:{
       formsubject_id: {
         type: Number,
         required: true // User can accept a userData object on params, or not. It's totally optional.
       }
    },
    data(){
      return {
        assess_id:0,
        assessments:[]
      }
    },
    watch:{
        formsubject_id:function(newVal){
            var self = this;
            axios.get('/listcomponents/assessments/'+newVal).then(function(result){
                console.log(result.data);
                self.assessments = result.data; 
            });
        }
    },
    mounted(){
        var self = this;
        axios.get('/listcomponents/assessments/'+this.formsubject_id).then(function(result){
            self.assessments = result.data; 
        });
    },
    methods:{
        announce:function(){
            console.log("Announce : "+this.assess_id);
            this.$emit('announce',this.assess_id);
        }
    }
  }
</script>
