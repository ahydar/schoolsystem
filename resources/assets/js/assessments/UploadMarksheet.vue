<template>
    <div>
        <div class="row">

         </div>
          <div class="row">
            <div class="col-md-12">
                <fileupload></fileupload>
            </div>
         </div>
    </div>
</template>

<script>
import ClassList from '../ListComponents/ClassList';
import UploadFile from '../components/UploadFile';
export default {
    components:{
        'classlist':ClassList,
        'fileupload':UploadFile
    },
    data(){
        return{
            date:'',
            form_id:'',
        }
    },
    created() {
          this.$root.pageHead = "Upload Mark Sheet ";
    },
    mounted(){

    },
    methods:{
    }
}
</script>

