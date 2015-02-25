var _; //globals

describe("About Applying What We Have Learnt", function() {

  var products;

  beforeEach(function () {
    products = [
       { name: "Sonoma", ingredients: ["artichoke", "sundried tomatoes", "mushrooms"], containsNuts: false },
       { name: "Pizza Primavera", ingredients: ["roma", "sundried tomatoes", "goats cheese", "rosemary"], containsNuts: false },
       { name: "South Of The Border", ingredients: ["black beans", "jalapenos", "mushrooms"], containsNuts: false },
       { name: "Blue Moon", ingredients: ["blue cheese", "garlic", "walnuts"], containsNuts: true },
       { name: "Taste Of Athens", ingredients: ["spinach", "kalamata olives", "sesame seeds"], containsNuts: true }
    ];
  });

  /*********************************************************************************/

  it("given I'm allergic to nuts and hate mushrooms, it should find a pizza I can eat (imperative)", function () {

    var i,j,hasMushrooms, productsICanEat = [];

    for (i = 0; i < products.length; i+=1) {
        if (products[i].containsNuts === false) {
            hasMushrooms = false;
            for (j = 0; j < products[i].ingredients.length; j+=1) {
               if (products[i].ingredients[j] === "mushrooms") {
                  hasMushrooms = true;
               }
            }
            if (!hasMushrooms) productsICanEat.push(products[i]);
        }
    }

    expect(productsICanEat.length).toBe(1);
  });

  it("given I'm allergic to nuts and hate mushrooms, it should find a pizza I can eat (functional)", function () {

    var productsICanEat = _(products).filter(function (x) 
				{
					return ((x.containsNuts == false) && (!_.contains(x.ingredients, "mushrooms"))) 
				});
      /* solve using filter() & all() / any() */

      expect(productsICanEat.length).toBe(1);
  });

  /*********************************************************************************/

  it("should add all the natural numbers below 1000 that are multiples of 3 or 5 (imperative)", function () {

    var sum = 0;
    for(var i=1; i<1000; i+=1) {
      if (i % 3 === 0 || i % 5 === 0) {
        sum += i;
      }
    }

    expect(sum).toBe(233168);
  });

  it("should add all the natural numbers below 1000 that are multiples of 3 or 5 (functional)", function () {

	/* try chaining range() and reduce() */
    var sum = _.range(1, 1000).reduce(
            function(/* result from last call */ memo, /* current */ x) 
			{ 
				if (x % 3 === 0 || x % 5 === 0) return memo + x;
				else return memo;
			}, 
			/* initial */ 0);    
	
    expect(233168).toBe(sum);
  });

  /*********************************************************************************/
   it("should count the ingredient occurrence (imperative)", function () {
    var ingredientCount = { "{ingredient name}": 0 };

    for (i = 0; i < products.length; i+=1) {
        for (j = 0; j < products[i].ingredients.length; j+=1) {
            ingredientCount[products[i].ingredients[j]] = (ingredientCount[products[i].ingredients[j]] || 0) + 1;
        }
    }

    expect(ingredientCount['mushrooms']).toBe(2);
  });

  it("should count the ingredient occurrence (functional)", function () {
    var ingredientCount = { "{ingredient name}": 0 };

    /* chain() together map(), flatten() and reduce() */
	_(products).chain()
						.map(function(x) { return x.ingredients; })
						.flatten()	
						.map(function(m) {
							ingredientCount[m] = (ingredientCount[m] || 0) + 1;
							return true
						});
                       /*.map(function(x) 
						{ 
							for (j = 0; j < x.ingredients.length; j+=1) {
								ingredientCount[x.ingredients[j]] = (ingredientCount[x.ingredients[j]] || 0) + 1;
							}
							//ingredientCount[x.ingredients[3]] = (ingredientCount[x.ingredients[0]] || 0) + 1;
							return true
						} );*/
									
    expect(ingredientCount['mushrooms']).toBe(2);		//ingredientCount['mushrooms']
  });

  /*********************************************************************************/
  /* UNCOMMENT FOR EXTRA CREDIT */
  
  it("should find the largest prime factor of a composite number", function () {
	var num = 1112, i,j,simmple = -1;
		for (i = num-1; i > 2; i--) {
			if (num % i == 0) 
			{
				//check i in prime
				for (j = i-1; j > 1; j--) 
				{
					//alert("j " + j);
					if (i % j == 0) break;
					if (j==2) { simmple = i; i = 0; break;}
				}
			}
		}
		expect(simmple).toBe(139);
  });

  it("should find the largest palindrome made from the product of two 3 digit numbers", function () {
		var tmp = 333, max = 0;
		for (i = 999; i > 99; i--) {
			for (j = 999; j > 99; j--) {
				tmp = i*j;
				if ( (tmp+"") == (tmp+"").split("").reverse().join(""))
				{
					if (max < tmp) max=tmp;	
					break;
				}
			}
		}
		expect(max).toBe(906609);
  });

  it("should find the smallest number divisible by each of the numbers 1 to 20", function () {
	var i,j,result = 0;
    for (i = 20; i < Number.MAX_VALUE; i++) {		//Number.MAX_VALUE
        for (j = 2; j < 21; j++) {
            if (i % j !== 0) break;
			if (j==20) { result = i; i= Number.MAX_VALUE; break; }
        }
    }
	
	  expect(result).toBe(232792560);
  });

  it("should find the difference between the sum of the squares and the square of the sums", function () {
		//=	-2ab
		var a = 983, b = 231, res;
		res = -2 * a*b;
		expect(res).toBe(-454146);
  });

  it("should find the 10001st prime", function () {
		var arr = [2,3,5];	//2,3,5
		for (var i = 7; i < Number.MAX_VALUE; i+=2) {
			if (i % 5 == 0) {continue;	}			//prime numbers ending in 1, 3, 7, 9, except numbers 2,5
			for (var j = 0; j < arr.length; j++) {
				if (i % arr[j] == 0) {break;}
				if (j > Math.sqrt(arr.length-1)) {arr.push(i); break;}		//check everything is not necessarily
			}
			if (arr.length == 10001) break;
		}	

		expect(arr[arr.length-1]).toBe(104743);
  });
  
});
