import Modal from "@/Components/Modal";
import { useState } from "react";
import { useForm } from "@inertiajs/react";

export default function Form({id=0, category = {}}){
    const [showModal, setShowModal] = useState(false);
    const {data, setData, post, put, errors, reset, clearErrors} = useForm({name:!category ? '': category.name, description: !category ? '':category.description});

    //funcion para abrir el modal cuando demos clic
    function OpenModal(){
        setShowModal(true);
    }

    //funcion para cerrar el modal cuando demos cancelar
    function CloseModal(e){
        e.preventDefault();
        setShowModal(false);
        clearErrors();
        reset();
    }

    const submitCategory = (e) =>{
        //e.preventDefault();
        console.log(data);

        if(id === 0){
            post(route('categories.store'), {
                onSuccess: (res) => {
                    console.log('OK', res);
                    //CloseModal();
                },
                onError: (error) => {
                    console.log('error', error)
                }
            })
        }
        else{
            console.log('update');
            put(route('categories.update', id), {
                onSuccess: (res) => {
                    console.log('OK', res);
                    CloseModal();
                },
            })
        }
    }
    return(
        <div>
            <div>
                { id === 0 ? (
                    <button onClick={OpenModal}>Crear nueva Categoria</button>
                ): (
                    <button onClick={OpenModal}>Editar Categoria</button>
                )}
            </div>
            <Modal show={showModal} closeable={true} onClose={setShowModal}>
                <h1>CREAR NUEVA CATEGORIA</h1>
                <form>
                    <label>Nombre de la Categoria</label>
                    <input type="text" name="name" value={data.name} onChange={(e) => setData('name', e.target.value)} />
                    {errors.name && (
                        <p>{errors.name}</p>
                    )}
                    <label>Descripcion de la categoria</label>
                    <input type="text" name="description" value={data.description} onChange={(e) => setData('description', e.target.value)}/>
                    <button onClick={CloseModal}>Cancelar</button>
                    <button onClick={submitCategory}>Guardar</button>
                </form>
            </Modal>
        </div>
    )
}
