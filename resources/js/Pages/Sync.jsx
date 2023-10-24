import { Link, Head, useForm } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import {useState} from 'react';

async function postData ( url, data ) {
  const form = new FormData();
  for ( let prop in data ){
    form.append( prop, data[prop] )
  }
  const response = await fetch( url, {
    method: 'POST',
    headers:{
     "Accept": "application/json"
    },
    body: form,
  })
  return response.json();
}

export default function Welcome({ auth, laravelVersion, phpVersion }) {
  /*let [ data, setData ] = useState({
    description: '',
    img: '',
    date: '',
    location: ''
  });*/
  
  const { data, setData, errors, post } = useForm({
    description: '',
    img: '',
    date: '',
    location: ''
  })
  
  //console.log(data)

  //let [ errors, setErrors ] = useState({})

  let [ statusMessage, updateStatusMessage ]  = useState( '' );
  
  //console.log( data );

  const onSubmit = e => {
    e.preventDefault();
    post( route( 'outing.store' )), { onSuccess: () => updateStatusMessage( 'Your information was submitted' ) }
  }; 
  
  return (
      <>
          <Head title="Submit Outing" />
          <header className="bg-gray-100">
            <div className="w-1/3 mx-auto px-5 py-2">
              <h1 className="text-center text-xl py-5 text-slate-800 font-semibold bg-white shadow-sm rounded-md">
                Testing by using web route
              </h1>
            </div>
          </header>
          <main className="bg-gray-100 h-screen">
            <section className="w-1/3 mx-auto p-5">
              <form onSubmit={onSubmit} className="p-5 shadow-md rounded-md bg-white">
                <div className="py-2">
                  <label className='block font-semibold' htmlFor="desc-input">Enter Description</label>
                  <textarea type="text" id="desc-input" onChange={e=>setData({...data, description: e.target.value})} value={data.description} />
                  <InputError message={errors.description} />
                </div>
                <div className="py-2">
                  <label className='block font-semibold' htmlFor="location-input">Location</label>
                  <input type="text" id="location-input" onChange={e=>setData({...data, location: e.target.value})} value={data.location} />
                  <InputError message={errors.location} />
                </div>
                <div className="py-2">
                  <label className='block font-semibold' htmlFor="date-input">Date</label>
                  <input type="date" id="date-input" value={data.date} onChange={e=>setData({...data, date: e.target.value})} />
                  <InputError message={errors.date} />
                </div>
                <div className="py-2">
                  <label className="block font-semibold" htmlFor="image-upload-input">Upload an image</label>
                  <input id="image-upload-input" type="file" onChange={ e => setData({...data, img: e.target.files[0] })}/>
                  <InputError message={errors.img} />
                </div>
                <div className="py-2">
                  <button className='bg-slate-800 text-white py-2 px-5'>Send Info</button>
                </div>
              </form>
              <div className="py-6">
                {statusMessage && (
                <div className="p-5 shadow-md rounded-md bg-white">
                  <p>{statusMessage}</p>
                  <button className="p-5 bg-gray-100" onClick={()=>updateStatusMessage('')}>Dismiss</button>
                </div>
                )}
              </div>
            </section>
          </main>
      </>
  );
}