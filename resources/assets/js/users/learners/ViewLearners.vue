<template>
  <div>
      <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <router-link tag="button" class="btn btn-primary" to="/learnerinfo">
                     New Learners
                </router-link>
              </div>
              <div class="panel-body">
                  <table  width="100%" class="table  table-bordered table-hover" :id="tableID">
                      <thead>
                        <tr>
                          <th v-for="col in columns">{{col.title}}</th>
                          <th>Subjects</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="learner in learners">
                          <td v-for="col in columns" >{{learner[col.field]}}</td>
                          <td>
                            <router-link :to="{ name: 'learnersubjects', params:{learner:learner}}" class="btn btn-info btn-xs">
                              Subjects
                            </router-link>
                          </td>
                          <td>
                            <router-link :to="{ name: 'learnerinfo', params:{learner:learner}}" class="btn btn-warning btn-xs">
                              Edit
                            </router-link>
                          </td>
                          <td><button v-on:click="remove(learner.id)" class="btn btn-danger btn-xs">Delete</button></td>
                        </tr>
                      </tbody>
                  </table>
              </div>
            </div>
          </div>
      </div>
    </div>
    
</template>
<script>
  import {dataTableLoad,destroyDataTable} from '../../services/dataTablesService';
  import learnerSubjects from './LearnerSubjects';
  export default {
    components:{'learner-subjects':learnerSubjects},
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
    created() {
          this.$root.pageHead = "Learners";
    },
    mounted(){
        var self = this;
        axios.get('learners').then(function(result){
            console.log(result);
            self.createTable(result.data.learners);
        });
    },
    methods:{
          remove:function(id){
            var self = this;
            axios.delete('learners/'+id).then(function(result){
                destroyDataTable(self.tableID);
                self.createTable(result.data.learners);
            })
          },
          createTable:function(learners){
            this.learners = learners;
            dataTableLoad(this.tableID);
          }
    }
  }
</script>
