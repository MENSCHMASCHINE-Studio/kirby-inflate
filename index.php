<?php
Kirby::plugin('MMS/inflate', [
    'collectionMethods' => [
        'inflate' => function ($size, $shuffle = false) {
            // Only run in debug mode
            if(! option('debug')){
                return $this;
            }

            // If not properly configured, return original collection
            if(!isset($size) || !is_int($size) || $size <= 0){
                return $this;
            }

            // If original collection is already larger than requested size, return it as is
            if($this->count() >= $size){
                return $this;
            }

            $collection = $this; // Start new collection with the original collection
            $originalCount = $this->count();

            for ($i = $this->count(); $i < $size; $i++) {
                // Get next item to add, cycling through original collection
                $item = $this->nth($i % (int)($originalCount));  
                if(!$item){
                    break;
                }

                // Add Item with a random suffix as key because Kirby collections require unique keys
                $rand = bin2hex(random_bytes(5));
                $key = $item->id() . '-' . $rand;
                $collection = $collection->append($key, $item);
            }

            if ($shuffle) {
                $collection = $collection->shuffle();
            }

            return $collection;
        }
    ]
]);