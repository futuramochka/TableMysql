var buttonForm = document.querySelector('.form__send');
var sectionTable = document.querySelector('.table__body');
var paginationButtons = document.querySelectorAll('.pagination__item ');
var arrayPaginationButtons = Array.from(paginationButtons);
var paramLimit = 4;
var paramOffset;

for(let i = 0; i < paginationButtons.length; i++){
    paginationButtons[i].addEventListener('click', function(e){
        e.preventDefault();
        var pageNum = e.target.textContent;
        paramOffset = (pageNum - 1) * paramLimit;
        objQueryPagin = {"Limit": "","Offset": ""};
        objQueryPagin["Limit"] = paramLimit;
        objQueryPagin["Offset"] = paramOffset;
        dbParamPagin = JSON.stringify(objQueryPagin);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                sectionTable.innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "ajax.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("p=" + dbParamPagin);
        
    })
}

document.querySelector('.form__selectOptions').addEventListener('change',ChangeValue);
document.querySelector('.form__selectOperators').addEventListener('change',ChangeValue);
document.querySelector('.form__text').addEventListener('change',ChangeValue);

function ChangeValue(){
    
    operator = document.querySelector('.form__selectOperators');
    text = document.querySelector('.form__text');
    nameColumn = document.querySelector('.form__selectOptions');
    objQuery = {"valueName": "", "valueOperator": "", "valueText": ""};
    objQuery["valueOperator"] = operator.value;
    objQuery["valueText"] = text.value;
    objQuery["valueName"] = nameColumn.value;
    buttonForm.onclick = function(evt){
       
        evt.preventDefault();
        //AJAX QUERY
        dbParam = JSON.stringify(objQuery);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                sectionTable.innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "ajax.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("x=" + dbParam);
    }
}
