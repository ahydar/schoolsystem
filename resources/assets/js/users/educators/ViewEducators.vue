<template>
  <div>
      <div class="row">
          <div class="col-md-12">
            <notifications />
            <div class="panel panel-default">
              <div class="panel-heading">
                <router-link tag="button" class="btn btn-primary" to="/educator">
                     New Educators
                </router-link>
              </div>
              <div class="panel-body">
                  <table  width="100%" class="table table-bordered table-hover" :id="tableID">
                      <thead>
                        <tr>
                          <th v-for="col in columns">{{col.title}}</th>
                          <th>Subjects</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="educator in educators">
                          <td v-for="col in columns" >{{educator[col.field]}}</td>
                          <td>
                            <router-link :to="{ name: 'educatorsubjects', params:{educator:educator}}" class="btn btn-info btn-xs">
                              Subjects
                            </router-link>
                          </td>
                          <td>
                            <router-link :to="{ name: 'edu', params:{educator:educator}}" class="btn btn-warning btn-xs">
                              Edit
                            </router-link>
                          <td><button v-on:click="remove(educator.id)" class="btn btn-danger btn-xs">Delete</button></td>
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
  export default {
    data(){
      return {
        tableID:'educators',
        educators:[],
        columns:[
          {title:'First Name',field:'firstName'},
          {title:'Last Name',field:'lastName'},
          {title:'Email',field:'email'},
          {title:'Gender',field:'gender'},
          {title:'Title',field:'title'},
          {title:'Initials',field:'initial'},
          {title:'Class',field:'formName'},
        ]
      }
    },
    created() {
          this.$root.pageHead = "Educators";
    },
    mounted(){
        var self = this;
        axios.get('educators').then(function(result){
            self.createTable(result.data.educators);
        });
    },
    methods:{
          remove:function(id){
            var self = this;
            axios.delete('educators/'+id).then(function(result){
                destroyDataTable(self.tableID);
                self.createTable(result.data.educators);
            })
          },
          createTable:function(educators){
            this.educators = educators;
            dataTableLoad(this.tableID);
          }
    }
  }
</script>
