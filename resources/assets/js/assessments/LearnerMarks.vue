<template>
    <div>
          <div class="row">
            <div class="col-md-2">
                <subjectslist @announce="getLearnerMarks"></subjectslist>
            </div>
            <div class="col-md-10">
                <learnermarkview v-if="showLearners" :formsubject_id="formsubject_id">
                </learnermarkview>
            </div>
         </div>
    </div>
</template>

<script>
import SubjectsList from '../ListComponents/SubjectsList';
import LearnerMarkView from './LearnerMarkView';
export default {
    components:{
        'subjectslist':SubjectsList,
        'learnermarkview':LearnerMarkView
        },
    data(){
        return{
            showLearners:false,
            formsubject_id:0,
        }
    },
    created() {
          this.$root.pageHead = "Learner Marks";
    },
    mounted(){

    },
    methods:{
        getLearnerMarks:function(formsubject_id){
            if(formsubject_id === 0){
                this.formsubject_id = formsubject_id;
                this.showLearners = false;
            }else{
                console.log("Received: "+formsubject_id);
                this.formsubject_id = formsubject_id;
                this.showLearners = true;
            } 
        }
    }
}
</script>

