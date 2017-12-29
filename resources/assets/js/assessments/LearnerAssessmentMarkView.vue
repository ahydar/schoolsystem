<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><u>Subject Name</u></h4>
            </div>
            <div class="panel-body">
                <table  width="100%" class=" table table-bordered table-hover" :id="tableID">
                    <thead>
                    <tr>
                        <th>Surname</th>
                        <th>Name</th>
                        <th v-for="task in tasks">
                            {{task}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="number in learnerNumbers">
                        <td v-if="learners[number]['lastName']" >
                            {{learners[number]['lastName']['name']}}
                        </td>
                        <td v-if="learners[number]['firstName']" >
                            {{learners[number]['firstName']['name']}}
                        </td>
                        <td v-for="task in tasks">
                            {{learners[number][task]['mark']}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<style>

</style>
<script>
  import {dataTableLoad,destroyDataTable} from '../services/dataTablesService';
  export default {
    props:{
       formsubject_id: {
         type: Number,
         required: true 
       }
    },
     watch:{
        formsubject_id:function(newVal){
            var self = this;
            axios.get('/learnerassessmentmarks/'+newVal).then(function(result){
                console.log(result.data);
                destroyDataTable(self.tableID);
                self.createTable(result.data);
            });
        }
    },
    data(){
      return {
        tableID:'learners',
        learners:[],
        learnerNumbers:[],
        tasks:[],
        columns:[
          {title:'First Name',field:'firstName'},
          {title:'Last Name',field:'lastName'},
          {title:'Mark',field:'mark'}
        ]
      }
    },
    mounted(){
        var self = this;
        axios.get('/learnerassessmentmarks/'+this.formsubject_id).then(function(result){
            console.log(result.data);
            self.createTable(result.data);
        });
        
    },
    methods:{
        announce:function(){

        },
        createTable:function(learners){
            this.learners = learners;
            this.learnerNumbers = Object.keys(this.learners);
            console.log(this.learnerNumbers);
            this.tasks = Object.keys(this.learners[this.learnerNumbers[0]]);
            console.log(this.tasks);
            
            this.learnerNumbers.forEach(function(element,index){
                this.learners[this.learnerNumbers[index]]['firstName'] = {
                    'name':this.learners[this.learnerNumbers[index]][this.tasks[0]]['firstName'],
                    'status':1
                };
                this.learners[this.learnerNumbers[index]]['lastName'] = {
                    'name':this.learners[this.learnerNumbers[index]][this.tasks[0]]['lastName'],
                    'status':1
                };
            },this);
            //this.learners[this.learnerNumbers[0]]['lastName'] = this.learners[this.learnerNumbers[0]][this.tasks[0]]['lastName'];
            console.log(this.learners);
            //destroyDataTable(this.tableID);
            dataTableLoad(this.tableID);
        }
    }
  }
</script>
