<template>
  <div>
        <div class="row" v-if="learnerPage">
            <div class="col-md-offset-2 col-md-8">
                <learnerinfoform @addGaurdian="addGaurdian" :learner="learner" ></learnerinfoform>
            </div>
        </div>

        <div class="row" v-if="!learnerPage">
            <div class="col-md-offset-2 col-md-8">
                <gaurdian @done="done" :learner_user_id="learner_user_id" :editting="editting"></gaurdian>
            </div>   
        </div>
  </div>
</template>
<script>
  import LearnerInfoForm from './LearnerInfoForm';
  import Gaurdian from './Gaurdian';
  export default {
    props:{
       learner: {
         type: Object,
         required: false // User can accept a userData object on params, or not. It's totally optional.
       }
    },
    components:{
      'learnerinfoform':LearnerInfoForm,
      'gaurdian':Gaurdian,
    },
    data(){
      return {
        learnerPage:true,
        learner_user_id:'',
        editting:false
      }
    },
    mounted(){
        this.$root.pageHead = "New Learner";
        console.log('Mounted');
        if(this.learner){
          this.$root.pageHead = "Edit Learner";
          this.editting  = true;
          console.log(this.learner);
        }
    },
    methods:{
      addGaurdian:function(learner_user_id){
            this.learner_user_id = learner_user_id;
            this.learnerPage = false;
            $("html, body").animate({ scrollTop: 0 }, "slow");
      },
      done:function(){
          $("html, body").animate({ scrollTop: 0 }, "slow");
          this.$router.push('/learners');
      }
    }
  }
</script>
