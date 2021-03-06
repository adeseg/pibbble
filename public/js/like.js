function like(projectID, count, likesValueOnModal, likesValueOnThumbnail, likeLink)
{
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var likesCount = xmlhttp.responseText;
            document.getElementById(likesValueOnThumbnail).innerHTML = likesCount;
            document.getElementById(likesValueOnModal).innerHTML = likesCount;

            if (likesCount <= count) {
                document.getElementById(likeLink).style.color = "#999";
            } else {
                document.getElementById(likeLink).style.color = "#2296cc";
            }
        }
    };

    xmlhttp.open("GET", "/project/like/"+projectID, true);
    xmlhttp.send();
}