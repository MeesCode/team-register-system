export default{

    install (Vue) {

        Vue.prototype.__ = (term, variables) => {
            let result = window.localization[term];

            // fill in the variables
            result = fillVariables(result, variables);

            return result;
        }

        Vue.prototype.trans = (term, variables) => {
            return __(term, variables)
        }

        Vue.prototype.trans_choice = (term, amount, variables = {}) => {
            let result = window.localization[term];

            // get the correct plurality
            result = getSubstring(result, amount);

            // fill in the variables
            result = fillVariables(result, variables);

            return result;
        }

        function getSubstring(result, amount){
            let substr = result.split('|');
            let setAmount = /^\s*(?:{\s*\d+\s*})|(?:\[(?:\s*\d+\s*|\s*\*\s*),(?:\s*\d+\s*|\s*\*\s*)\])/;

            // case 1 there is no more than one substring, always return the only one available
            if(substr.length == 1){
                return substr[0];
            }

            // case 2 there are 2 substrings without set amounts, return either singular or plural
            if(substr.length == 2 && !setAmount.test(substr[0]) && !setAmount.test(substr[1])){
                if(amount <= 1){
                    return substr[0]
                }
                return substr[1]
            }

            // case 3 all substrings have a defined amount
            // loop over all substring until you find one that fits
            let singleAmount = /^\s*{\s*(\d+)\s*}/;
            let rangeAmount = /^\s*\[\s*(\d+|\*)\s*,\s*(\d+|\*)\s*\]/;
            for(let str of substr){                
                let single = singleAmount.exec(str);
                let range = rangeAmount.exec(str);
                let returnString = str.replace(setAmount, '')
                if(single && amount == single[1]){
                    return returnString;
                } 
                if(range && range.length == 3 && ((range[1] == '*' || range[1] <= amount) && (range[2] == '*' || range[2] >= amount))){
                    return returnString;
                }
            }

            // fallback, return the first substring but sanitized
            let returnString = substr[0].replace(setAmount, '')
            return returnString;
        }

        function fillVariables(result, variables){
            // iterate over things to be replaced
            for(let [k, v] of Object.entries(variables)){

                // find the index of the thing to be repaced
                let index = result.toLowerCase().search(':'+k.toLowerCase());

                // not found, so go to next term
                if(index == -1){
                    continue;
                }

                // get the representation of the variable in the locale file
                let slice = result.slice(index + 1, k.length + index + 1)

                // if it's strictly uppercase, replace with uppercase variant
                if(isUpperCase(slice)){
                    result = result.replaceAll(':'+slice, v.toUpperCase());
                    continue;
                }

                // if it's strictly capitalized, replace with capitalized variant
                if(isCapitalized(slice)){
                    result = result.replaceAll(':'+slice, v.capitalize());
                    continue;
                }

                // if it's neither, just replace the variable directly
                result = result.replaceAll(':'+slice, v);
            }

            return result;
        }

        String.prototype.replaceAll = function(search, replacement) {
            var target = this;
            return target.replace(new RegExp(search, 'g'), replacement);
        };

        String.prototype.capitalize = function() {
            return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
        };

        function isUpperCase(str) {
            return str === str.toUpperCase();
        }

        function isCapitalized(str) {
            return str === str.capitalize();
        }

    }

}