<template>
</template>

<script>
import axios from 'axios'
export default {
    props: ['userId'],
    data () {
        return {
            profile: [],
            erros: []
        }
    },
    created () {
        axios.get('/api/users')
        .then(response => {
            this.profile = response.data
        })
        .catch(e => {
            this.errors.push(e)
        })
    }
}
</script>