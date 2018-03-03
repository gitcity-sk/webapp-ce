<template>
    <button v-on:click="deleteItem" class="btn btn-danger">Delete license</button>
</template>

<script>
    import axios from 'axios'
    export default {
        mounted () {
            console.log('Component GroupsTable mounted.')
        },
        props: ['url', 'redirect'],
        data () {
            return {
                done: false,
                groups: {
                    data: []
                },
                errors: []
            }
        },
        methods: {
            deleteItem: function() {
                console.log(this.url)

                axios.delete(this.url)
                .then(response => {
                    window.location.href = this.redirect
                })
                .catch(e => {
                    this.errors.push(e)
                })
            }
        }
    }
</script>