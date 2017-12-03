<template>
  <div>
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">Educators</h4>

        </div>
    </div>
      <div class="row">
          <div class="col-md-12">
            <notifications />
            <div class="panel panel-default">
              <div class="panel-heading">
                <router-link tag="button" class="btn btn-primary" to="/new_educator">
                     New Educators
                </router-link>
              </div>
              <div class="panel-body">
                  <table  width="100%" class="table table-striped table-bordered table-hover" :id="tableID">
                      <thead>
                        <tr>
                          <th v-for="col in columns">{{col.title}}</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="educator in educators">
                          <td v-for="col in columns" >{{educator[col.field]}}</td>
                          <td><button class="btn btn-warning btn-xs">Edit</button></td>
                          <td><button class="btn btn-danger btn-xs">Delete</button></td>
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
    mounted(){
        var self = this;
        axios.get('educators').then(function(result){
            self.educators = result.data.educators;
            dataTableLoad(self.tableID);
        });
    },
    methods:{

    }
  }
</script>
