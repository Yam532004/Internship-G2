// 1. getElementById => trả lề HTML collection
// 2. getElementsByClassName
// 3. getElementsByTagName
// 4. querySelector => trả lề HTML collection
// 5. querySelectorAll => trả về noode list 
// 6. HTML collection 
// 7. document.write

var inputElement = document.querySelector('input[type="text"]');
inputElement.onkeydown = function (e){
    console.log(e.target.value);
}

var inputElement = document.querySelector('input[type="checkbox"]');
inputElement.onchange = function (e){
    console.log(e.target.checked);
}

var inputElement = document.querySelector('select');
inputElement.onchange = function (e){
    console.log(e.target.value);
}
//Tạo kiểu class

class Courses {
    constructor (name, price){
        this.name = name;
        this.price = price;
    }
    getName() { return this.name; }
    getPrice() { return this.price; }
    setName(name) { this.name = name; }
    setPrice(price) { this.price = price; }
}

const phpCourse = new Courses("PHP Course", 500)

console.log(phpCourse.name);