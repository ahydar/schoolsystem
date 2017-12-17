<template>
  <div>
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">Assessments</h4>
            <notifications />
        </div>
    </div>
   </div>   
</template>
<script>
  import {dataTableLoad,destroyDataTable} from '../services/dataTablesService';
  export default {
    data(){
      return {
        tableID:'learners',
        learners:[],
        columns:[
          {title:'First Name',field:'firstName'},
          {title:'Last Name',field:'lastName'},
          {title:'Email',field:'email'},
          {title:'Gender',field:'gender'},
          {title:'Learner Number',field:'learnerNumber'},
          {title:'Years in Phase',field:'yearsInPhase'},
          {title:'Class',field:'formName'},
        ]
      }
    },
    mounted(){

    },
    methods:{
        
    }
  }
</script>
