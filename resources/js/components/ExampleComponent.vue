<template>
    <div class="container">
        <input type="button" value="" @click="click">
        <br>
        <input type="checkbox" name="" id="" v-model="checked">
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                checked: false
            };
        },
        methods:{
            click(){
                if (this.checked == true) {
                    this.checked = false
                } else {
                    this.checked = true
                    
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
