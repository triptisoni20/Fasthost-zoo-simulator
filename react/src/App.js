import './App.css';
import {useEffect, useState} from "react";
import axios from "axios";

function App() {
    //states`
    const [time, setTime] = useState('')
    const [monkeys, setMonkeys] = useState([])
    const [giraffes, setGiraffes] = useState([])
    const [elephants, setElephants] = useState([])

    /**
     * Get time from API
     * Get list of animals from API
     */
    useEffect(() => {
        // URLs for the two API requests
        const urlGetTime = 'http://localhost:8110/time';
        const urlGetAnimals = 'http://localhost:8110/animals';


        // Make the two API requests simultaneously
        const requestGetTime = makeRequest(urlGetTime);
        const requestGetAnimals = makeRequest(urlGetAnimals);

        // Wait for both requests to finish
        Promise.all([requestGetTime, requestGetAnimals])
            .then(([time, animals]) => {
                // Handle the responses here
                //set time
                setTime(time)

                //set animals
                setMonkeys(animals['monkeys'])
                setGiraffes(animals['giraffes'])
                setElephants(animals['elephants'])
            })
            .catch(error => {
                // Handle error if any of the requests fail
                console.error('Error:', error);
            });
    }, [])

    //function to handle feeding animals
    const handleFeedAnimals = (event) => {
        //prevent default
        event.preventDefault()

        // URLs for the two API requests
        const urlFeedAnimals = 'http://localhost:8110/feed';

        // Make the two API requests simultaneously
        const requestFeedAnimals = makeRequest(urlFeedAnimals);

        // Wait for both requests to finish
        Promise.all([requestFeedAnimals])
            .then(([animals]) => {
                // Handle the responses here
                //set animals
                setMonkeys(animals['monkeys'])
                setGiraffes(animals['giraffes'])
                setElephants(animals['elephants'])
            })
            .catch(error => {
                // Handle error if any of the requests fail
                console.error('Error:', error);
            });
    }

    //function to handle fast forward
    const handleFastForward = (event) => {
        //prevent default
        event.preventDefault()

        // URLs for the two API requests
        const urlFastForward = 'http://localhost:8110/fast-forward';

        // Make the two API requests simultaneously
        const requestFastForward = makeRequest(urlFastForward);

        // Wait for both requests to finish
        Promise.all([requestFastForward])
            .then(([response]) => {
                // Handle the responses here
                //get time from response
                const time = response['time']
                //set time
                setTime(time)

                //get animals from response
                const animals = response['animals']
                //set animals
                setMonkeys(animals['monkeys'])
                setGiraffes(animals['giraffes'])
                setElephants(animals['elephants'])
            })
            .catch(error => {
                // Handle error if any of the requests fail
                console.error('Error:', error);
            });
    }

    // Function to make an Axios request and return a promise
    function makeRequest(url) {
        return axios.get(url, {withCredentials: true})
            .then(response => response.data)
            .catch(error => {
                console.error(`Error making request to ${url}:`, error);
                throw error;
            });
    }

    return (
   <>
       <div className="text-center m-5">
           <p className={`header text-5xl`}>Zoo Simulator</p>
       </div>
       <div className="text-center m-5">
           <p className={`time font-medium text-3xl`}>Current Time:</p>
           <p className={`time font-medium text-3xl`}>{time}</p>
       </div>
       <div className="grid grid-cols-3 gap-5 m-5">
           <div className="bg-white rounded-lg shadow-lg p-5">
               <div className={`container-header text-center font-bold`}>Monkeys</div>
               <div className={`grid grid-cols-3 gap-5 m-5`}>
                   {monkeys.map((animal, index) => (
                       <div key={index} className={`container-body text-center ${animal['isAlive'] ? 'bg-emerald-600' : 'bg-rose-600 text-white divide-white'} rounded-lg ${index === (monkeys.length -1) ? 'col-span-2' : 'aspect-square'} flex flex-col justify-center items-center divide-y divide-black shadow-lg shadow-purple-600`}>
                           <p>{animal['title']}</p>
                           <p>{animal['isAlive'] ? animal['health'] : 'Dead'}</p>
                       </div>
                   ))}
               </div>
           </div>
           <div className="bg-white rounded-lg shadow-lg p-5">
               <div className={`container-header text-center font-bold`}>Giraffes</div>
               <div className={`grid grid-cols-3 gap-5 m-5`}>
                   {giraffes.map((animal, index) => (
                       <div key={index} className={`container-body text-center ${animal['isAlive'] ? 'bg-emerald-600' : 'bg-rose-600 text-white divide-white'} rounded-lg ${index === 0 ? 'col-span-2' : 'aspect-square'} flex flex-col justify-center items-center divide-y divide-black shadow-lg shadow-purple-600`}>
                           <p>{animal['title']}</p>
                           <p>{animal['isAlive'] ? animal['health'] : 'Dead'}</p>
                       </div>
                   ))}
               </div>
           </div>
           <div className="bg-white rounded-lg shadow-lg p-5">
               <div className={`container-header text-center font-bold`}>Elephants</div>
               <div className={`grid grid-cols-3 gap-5 m-5`}>
                   {elephants.map((animal, index) => (
                       <div key={index} className={`container-body text-center ${animal['isDisabled'] ? `${animal['isAlive'] ? 'bg-orange-400' : 'bg-rose-600 text-white divide-white'}` : 'bg-emerald-600'} rounded-lg ${index === (elephants.length - 2) ? 'col-span-2' : 'aspect-square'} flex flex-col justify-center items-center divide-y divide-black shadow-lg shadow-purple-600`}>
                           <p>{animal['title']}</p>
                           <p>{animal['isAlive'] ? animal['health'] : 'Dead'}</p>
                       </div>
                   ))}
               </div>
           </div>
       </div>
       <div className={`flex flex-row gap-5 m-5 justify-end`}>
           <button className="w-40 bg-lime-600 px-5 py-2 text-white font-bold rounded-full" onClick={handleFeedAnimals}>Feed Animals</button>
           <button className="w-40 bg-purple-600 px-5 py-2 text-white font-bold rounded-full" onClick={handleFastForward}>Fast Forward</button>
       </div>
   </>
  );
}

export default App;
