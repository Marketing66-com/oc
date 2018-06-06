var demo = angular.module('demo', ['ui.sortable']);

demo.controller("SimpleDemoController", function($scope) {
    $scope.list1 = [
        {
            _id: "5a391a79734d1d2f5954ca27",
            name: "Etoro",
            logo: "https://www.interactivecrypto.com/wp-content/uploads/brokersimg/newbrokers/etoro_2.png",
            min_depot: 100,
            crypto: "https://www.interactivecrypto.com/wp-content/uploads/2017/11/crypto_paslourds-8.png",
            user_score: 9.7,
            review_link: "https://www.interactivecrypto.com/etero-broker-review/",
            regulation: "https://www.interactivecrypto.com/wp-content/uploads/2017/11/FlagEtoro.png",
            button_link: "https://marketing66.go2cloud.org/aff_c?offer_id=4&aff_id=1064&url_id=466"
        },
        {
            _id: "5a391a89734d1d2f5954ca2a",
            name: "Plus500",
            logo: "https://www.interactivecrypto.com/wp-content/uploads/brokersimg/newbrokers/plus500_2.png",
            min_depot: 100,
            crypto: "https://www.interactivecrypto.com/wp-content/uploads/2017/11/crypto_paslourds-8.png",
            user_score: 9.7,
            review_link: "https://www.interactivecrypto.com/more500-broker-review/",
            regulation: "https://www.interactivecrypto.com/wp-content/uploads/2017/12/FlagPlus500-1.png",
            button_link: "http://marketing66.go2cloud.org/aff_c?offer_id=72&aff_id=1064"
        },
        {
            _id: "5a391aa0734d1d2f5954ca31",
            name: "Trade",
            logo: "https://www.interactivecrypto.com/wp-content/uploads/brokersimg/newbrokers/trade_2-2.png",
            min_depot: 100,
            crypto: "https://www.interactivecrypto.com/wp-content/uploads/2017/11/crypto_paslourds-8.png",
            user_score: 9.7,
            review_link: "https://www.interactivecrypto.com/trade-com-review/",
            regulation: "https://www.interactivecrypto.com/wp-content/uploads/2017/12/FlagChypre.png",
            button_link: "http://marketing66.go2cloud.org/aff_c?offer_id=84&aff_id=1064&url_id=610"
        }
    ];

    $scope.sortableOptions = {
        stop: function(e, ui) {
            console.log("finished",$scope.people)
        }
    };
});
