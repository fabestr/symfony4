
var styleButton = document.querySelector('#styleButton');

var table = document.querySelector("#artistShow");
var artistId = table.dataset.id;
var sameStyleArtist = document.querySelector("#sameStyleArtist");

styleButton.addEventListener('click' , showSameStyle);



function showSameStyle()
{
    fetch(`/artist/${artistId}/same_style`)
    .then(function(response){
        return response.json();
    })
    .then(function(myjsonResponse) {
       // console.log(myjsonResponse);
        sameStyleArtist.innerHTML = "";
        for(var i=0; i < myjsonResponse.length ; i++)
        {
            
            var e=document.createElement("p");
            if(myjsonResponse[i]["id"]!= artistId)
            {
                e.innerHTML=`<a href="${myjsonResponse[i]["href"]}">${myjsonResponse[i]["nom"]}</a>`;
                sameStyleArtist.appendChild(e);
            }
            
           
        }
        
    });
}


