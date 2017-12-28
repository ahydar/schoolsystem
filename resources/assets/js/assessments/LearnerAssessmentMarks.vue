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
                <subjectslist @announce="getLearners"></subjectslist>
            </div>
         </div>
          <div class="row">
            <div class="col-md-12">
                <learnerassessmentmarkview v-if="showLearners" :formsubject_id="formsubject_id">
                </learnerassessmentmarkview>
            </div>
         </div>
    </div>
</template>

<script>
import SubjectsList from '../ListComponents/SubjectsList';
import AssessmentsList from '../ListComponents/AssessmentsList';
import LearnerAssessmentMarkView from './LearnerAssessmentMarkView';
export default {
    components:{
        'subjectslist':SubjectsList,
        'assesslist':AssessmentsList,
        'learnerassessmentmarkview':LearnerAssessmentMarkView
        },
    data(){
        return{
            showAssessList:false,
            showLearners:false,
            formsubject_id:0,
        }
    },
    mounted(){

    },
    methods:{
        getLearners:function(formsubject_id){
            this.formsubject_id = formsubject_id;
            this.showLearners=true;
        }
    }
}
</script>

