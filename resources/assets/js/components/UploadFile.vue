<template>
    <div>
        <form method="post" enctype="multipart/form-data" @submit.prevent="upload($event.target.file)">  
            Select image to upload:
            <input type="file" name="marksheet" id="fileToUpload" 
            @change="filesChange($event.target.name, $event.target.files)">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            formdata : new FormData()
        }
    },
    created() {
          this.$root.pageHead = "Learner Daily Attendance";
    },
    mounted(){

    },
    methods:{
        upload:function(){
            console.log("displaying");
            console.log(this.formdata);
            axios.post('upload',this.formdata).then(result => {
                console.log(result.data);
            });
        },
        filesChange:function(name,files){
            console.log(name);
            console.log(files[0]);
            this.formdata.append(name,files[0]);
        }
    }
}
</script>

