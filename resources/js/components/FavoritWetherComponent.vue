<template>
    <div class="form-wether">

        <div v-for="item in main_list"  class="wether-block">
            <div class="wether-block-info">
              <div class="wether-block-text">
                <p> {{item.name}}</p>
                <p> Температура {{Math.round(item.temp - 273.15)}}</p>
                <p> Ощущается как {{Math.round(item.feels_like - 273.15)}}</p>
                <p>{{item.description}}</p>
              </div>
                <img :src='"http://openweathermap.org/img/wn/"+item.icon+"@2x.png"' alt="">
                <p v-on:click="add_favorit(item.name)">Добавить в избранное</p>
            </div>
        </div>
        <p v-on:click='get_favorit'>кнопка</p>

    </div>
</template>

<script>
export default {
    name: "wether-component",
    data(){
        return{
            cityName: 'london',
            apiKey: 'a26a983a15e39d7203163ab71ce56c57',
            dataJson: {},
            main_list:[],
            test:0,
            error_chek:'',
            user:1,

        }
    },
    methods: {
        getWeather(){

            $.ajax({
                url:`http://api.openweathermap.org/data/2.5/weather?q=${this.cityName}&appid=${this.apiKey}&lang=ru`,
                method:"GET",
                success: res => {
                    this.dataJson = res;
                    this.main_list.push(Object.assign(this.dataJson.main, this.dataJson.weather[0], this.dataJson));
                },
                error: err => console.log(err),
            });
            this.test++
        },
        add_favorit(name){
            axios.post('/api/add_favorit', {city:name}).catch((error)=>this.error_chek=error);
            console.log(this.$userId);
        },
        get_favorit(){
          axios.get('/api/get_favorit').then((main_list)=>this.cityName = main_list.city)
        },

    },

    async mounted(){
       this.getWeather();
       this.get_favorit();

  },

}
</script>

<style scoped>
.wether-block-info{
  background-color: #9EC3E8;
  border-radius: 30px;
  padding: 10px;
  width: 1000px;
}
.wether-block-info img{
  display: flex;
  border-radius: 50%;
  box-shadow: 0 0 10px rgba(0,0,0,0.5);
  background-color: #d1d1e5;
}
.wether-block-info{
  display: flex;
  justify-content: space-around;
  align-items: center;
}
.wether-block{
    display: flex;
    justify-content: center;
    margin-top: 20px;
}
.wether-block-text{
  display: flex;
}
.wether-block-text p{
  margin-right: 20px;
}
</style>
