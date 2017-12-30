<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <crudtable
                :columns="columns" :items="items" newBtn="New Subject" :table="table"
                @add = "formAction" @edit = "formAction" @remove="removeCheck"
                ></crudtable>
                <notifications />

                <modal modalID="myModal">
                  <div slot="header"><h3>{{action}}</h3></div>
                  <div slot="body">
                    <form @submit.prevent="save" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)">
                        <div class="form-group">
                          <label for="usr">Subject Name:</label>
                          <input class="form-control" name='subjectName' v-model="form.subjectName">
                          <span style="color:red;" v-text="form.errors.get('subjectName')"></span>
                        </div>

                        <button type="submit" :disabled="form.errors.any()" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </modal>

                <confirm
                message="Are you sure you want to remove this subject? Note: all learners and marks linked to this subject will be removed."
                btnClass="danger" v-on:confirmed="remove" :modalID="deleteModalId"></confirm>

            </div>
        </div>
    </div>
</template>

<script>
    import {Form} from '../services/form';
    import CrudCollection from '../components/CrudCollection';
    import CrudTable from '../components/CrudTable';
    import {dataTableLoad,destroyDataTable} from '../services/dataTablesService';
    export default {
        extends:CrudCollection,
        components:{'crudtable':CrudTable},
        data(){
          return {
            name:'Subject',
            form: new Form({
                subjectName:''
            }),
            table:'subjectTable',
            url:'/subjects',
            columns:[
              {title:'Subject Name',field:'subjectName'}
            ]
          }
        },
        created() {
            this.$root.pageHead = "Subjects";
        },
        methods:{
          createTable:function(data){
            this.items = data.subjects;
            dataTableLoad(this.table);
          }
        }
    }
</script>
