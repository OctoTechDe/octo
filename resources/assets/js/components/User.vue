<template>
    {{ user.name }}
</template>

<script>
    export default {
        data() {
            return {
                user: ''
            };
        },
        ready() {
            console.log('Component ready.')

            this.$http.get('api/user')
                    .then(response => {
                        console.log(response.data);
                        this.user = response.data;
            });
        }
    }
</script>
