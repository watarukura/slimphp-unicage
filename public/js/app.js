const app = new Vue({
    el: '#app',
    data () {
        return {
            info: null
        }
    },
    mounted () {
        axios
            .get('http://localhost:8000/api/User/Hello?User=Taro')
            .then(response => (this.info = response.data))
            .catch(function(error) {
                console.log('error occurred!')
                console.log(error)
            })
    }
})