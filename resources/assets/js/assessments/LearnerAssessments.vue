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
                <learnerassessmentview v-if="showLearners" :assessment_id="assessment_id">
                </learnerassessmentview>
            </div>
         </div>
    </div>
</template>

<script>
import SubjectsList from '../ListComponents/SubjectsList';
import AssessmentsList from '../ListComponents/AssessmentsList';
import LearnerAssessmentView from './LearnerAssessmentView';
export default {
    components:{
        'subjectslist':SubjectsList,
        'assesslist':AssessmentsList,
        'learnerassessmentview':LearnerAssessmentView
        },
    data(){
        return{
            showAssessList:false,
            showLearners:false,
            formsubject_id:0,
            assessment_id:0
        }
    },
    mounted(){

    },
    methods:{
        getAssessments:function(formsubject_id){
            console.log("Received: "+formsubject_id);
            this.formsubject_id = formsubject_id;
            if(formsubject_id === 0){
                this.showAssessList = false;
                this.showLearners = false;
            }else{
                this.showAssessList = true;
            }
        },
        getLearnerAssessments:function(assess_id){
            console.log("Received: "+assess_id);
            this.assessment_id = assess_id;
            this.showLearners=(assess_id === 0?false:true);
        }
    }
}
</script>

