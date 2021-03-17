const MAXIMUM_COMMENT_CAPACITY = 5; // number of comments to be shown if the show more button is not clicked
const commentObjects = [];
var commentsHidable = [];

var isCommentHidable = false;
var isShown = false; // flag for listener



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
    commentsHidable = commentObjects.slice(MAXIMUM_COMMENT_CAPACITY - 1);
}

//test
alert(commentsHidable.length);
for(let i = 0; i < commentsHidable.length; i++)
{
    print(i);
}

function print (i)
{
    setTimeout(function(){alert(commentsHidable[i].innerHTML)}, 2000 * i + 2000);
}