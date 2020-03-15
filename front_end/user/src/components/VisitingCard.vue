<template>
 <div id="WelcomeDiv" style="width: 500px;
    height: 200px;    overflow: hidden;
    background-color:rgb(37, 74, 100)
    " ref="box">
    <img id="BackGround" src="../../static/img/background.png" class="WelcomePart" style="position:relative;z-index:2;;
    margin-top:-320px;margin-left: -250px;">
    <img id="ForeGround" src="../../static/img/mask.png" class="WelcomePart" style="position:relative;margin-top: -190px;z-index:100001">
  </div>
</template>

<script>
export default {
    name: 'VisitingCard'
}
</script>

<style scoped>
#BackGround{
    z-index: 100;
    width:100%;
    left: 28%;
    animation:changDeg 30s linear 0.2s infinite;
}

@keyframes changDeg{
    0%{
        transform: rotate(0deg);
    }
    100%{
        transform: rotate(360deg);
    }
}

#Foreround{
    width:80%;
    left: 10%;
}
</style>
