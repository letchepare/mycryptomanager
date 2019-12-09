<template>

    <table class="table">
    <thead>
        <tr>
        <th scope="col">Connexion Name</th>
        <th scope="col">Api key</th>
        <th scope="col">Api secret</th>
        <th scope="col">Api Passphrase</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>

            <tr v-for="exchange in exchanges">
            <th scope="row">{{exchange.connexion_name}}</th>
            <td>{{exchange.api_key}}</td>
            <td>{{exchange.api_secret}}</td>
            <td>{{exchange.api_passphrase}}</td>
            <td>
                <a :href="'/list-trades/'+exchange.id"><button type="button" class="btn btn-outline-dark"><font-awesome-icon icon="eye" /></button></a>
            </td>
            </tr>
    </tbody>
    </table>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data: function(){
            return {}
        },
        props: ['exchanges']
    }
</script>
