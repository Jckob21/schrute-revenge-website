const MAXIMUM_COMMENT_CAPACITY = 5; // number of comments to be shown if the show more button is not clicked
const commentObjects = [];
const commentButton = document.getElementById("commentButton");
var commentsHidable = [];

var isCommentHidable = false;
var isShown = true; // flag for listener
setTimeout(function(){ showHide() }, 100); // default = hide elements
setTimeout(function(){ commentButton.addEventListener("click", showHide) }, 100);

// find all comments
let counter = 0;
while(document.getElementById('c' + counter) != null)
{
    commentObjects.push(document.getElementById('c' + counter));
    counter++;
    //alert('c' + counter + " element found!");
}

/*
    Check if there is enough comments for the script to be working
    if so set commentsHidable to the part of commentObjects to be hidden/shown
*/
if(commentObjects.length > MAXIMUM_COMMENT_CAPACITY)
{
    isCommentHidable = true;
    commentsHidable = commentObjects.slice(MAXIMUM_COMMENT_CAPACITY);
}

function showHide()
{
    if(isShown)
    {
        commentsHidable.forEach(hide);
        commentButton.innerHTML = "Pokaż więcej";
    } else
    {
        commentsHidable.forEach(show);
        commentButton.innerHTML = "Pokaż mniej";
    }

    isShown = !isShown;
}

function hide(item)
{
    item.style.display = 'none';
}

function show(item)
{
    item.style.display = 'block';
}

/*          COMMENTS SHORTABLE          */

commentObjects.forEach(defineCommentShortable);


//defineCommentShortable(commentObjects[0]);
//defineCommentShortable(commentObjects[1]);

function defineCommentShortable(commentObject)
{
    // if the comment is long or has a lot of new line chars make it shortable
    if(commentObject.innerHTML.length > 400 || commentObject.innerHTML.split(/\r\n|\r|\n/).length > 6)
    {
        commentObject.innerHTML = commentObject.innerHTML + "<div class='shortable'>pokaż mniej</div>";

        commentObject.getElementsByClassName("shortable")[0].addEventListener("click", function(){makeCommentShorterLonger(commentObject)});
    }
}

function makeCommentShorterLonger(commentObj)
{
    /* if comment is partly hidden:
     * 1) remove 'comment-container-short' class from the element
     * 2) switch the button content to 'show more'
     * else
     * 1) add 'comment-container-short' class to the element
     * 2) switch the button content to 'show less'
     */
    if(commentObj.classList.contains("comment-container-short"))
    {
        commentObj.classList.remove("comment-container-short");
        commentObj.getElementsByClassName("shortable")[0].innerHTML = "pokaż mniej";
    } else
    {
        commentObj.classList.add("comment-container-short");
        commentObj.getElementsByClassName("shortable")[0].innerHTML = "pokaż więcej";
    }
}