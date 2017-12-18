<template>
  <div>
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-header">Assessments</h4>
            <notifications />
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">Subjects</div>
              <div class="panel-body">
                   <ul class="list-group">
                      <li class="list-group-item" v-for='sub in subjects'><button class="btn btn-xs" @click="assessments(sub)">{{sub.subjectName}}</button></li>
                    </ul>
              </div>
            </div>

        </div>
        <div class="col-md-9">
            <table class="table">
              <thead slot="head">
                <tr>
                  <th v-for="col in columns">
                    {{col.title}}
                  </th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody slot="body">
                <tr v-for="item in assess">
                    <td v-for="col in columns">
                        {{item[col.field]}}
                    </td>
                    <td> <button type="button" @click="edit(item)" class="btn btn-primary btn-xs">Edit</button></td>
                    <td> <button type="button" @click="remove(item)" class="btn btn-danger btn-xs">Delete</button></td>
                </tr>
              </tbody>
            </table>
        </div>
    </div>
   </div>   
</template>
<script>
  import {dataTableLoad,destroyDataTable} from '../services/dataTablesService';
  export default {
    data(){
      return {
        subjects:[],
        assess:[],
        tableID:'learners',
        learners:[],
        columns:[
          {title:'Name',field:'assessName'},
          {title:'Mark',field:'assessMark'},
          {title:'Term %',field:'assessTermPercentage'},
          {title:'Final %',field:'assessFinalPercentage'},
        ]
      }
    },
    mounted(){
        var self = this;
        axios.get('/assessments').then(function(result){
            self.subjects = result.data;
            console.log(result.data);
        });
    },
    methods:{
        assessments:function(sub){
          this.assess = sub.assessments;
          console.log(this.assess);
        }
    }
  }
</script>
