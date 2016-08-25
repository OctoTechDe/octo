<template>
    <div class="block block-condensed">
        <div class="block-heading">
            <div class="app-heading app-heading-small">
                <div class="title">
                    <h2>Users</h2>
                    <p>Overview about your Users</p>
                </div>
                <div class="heading-elements">

                </div>
            </div>
        </div>
        <div class="block-content">

            <table class="table table-head-light table-striped">
                <thead>
                <tr>
                    <th>name</th>
                    <th>actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users">
                    <td>
                        {{ user.name }}
                    </td>
                    <td>
                        <button class="btn btn-default btn-icon"><span class="fa fa-pencil"></span></button>
                        <button class="btn btn-default btn-icon"><span class="fa fa-times"></span></button>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>

<script>
    export default {
        data() {
        return {
            users: ''
        };
    },
    ready() {
        console.log('Component ready.')

        this.$http.get('api/getusers')
                .then(response => {
            console.log(response.data);
        this.users = response.data;
    });
    }
    }
</script>
