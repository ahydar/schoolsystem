<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-header">Learner Assessments</h4>
                <notifications />
            </div>
         </div>

          <div class="row">
            <div class="col-md-4">
                <subjectslist @announce="getAssessments"></subjectslist>
                <hr>
                <assesslist v-if="showAssessList" :formsubject_id="formsubject_id" @announce="getLearnerAssessments"></assesslist>
            </div>
            <div class="col-md-8">
                <learnermarkview v-if="showLearners" :assessment_id="assessment_id">
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
    mounted(){

    },
    methods:{
        getLearnerMarks:function(formsubject_id){
            console.log("Received: "+formsubject_id);
            //this.formsubject_id = formsubject_id;
            //this.showAssessList = true;
        }
    }
}
</script>

