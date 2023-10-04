"strict-mode";

class app
{
    constructor()
    {
        this.tree = '';
    }

    getRecords(callback)
    {
        return $.ajax({
            type        :   'POST',
            url         :   'fetch-records',
            success     :   responce =>(responce['status'] !== undefined && responce.status === true) ? callback(responce.data) : Swal.fire('Opps!','There was an error while trying to fetch records.','error'),
            error       :   (xhr,err)=> Swal.fire('Opps!','Somthing went wrong','error')
        });
    }

    setParent()
    {
        this.getRecords(records => $('select[name=parent]').html(`<option value="0" selected>Select Parent</option>`+records.map(data => `<option value="${data.id}">${data.Name}</option>`).join('')));
        // $('select[name=parent]').select2();
    }
    
    verify(input = null)
    {
        return (input != '' && input != '0' && input.length > 0) ? true : false;
    }

    validateForm()
    {
        if(this.verify($('input[name=mname]').val()) === false)
        {
            Swal.fire(
                'Warning',
                'Plese enter name',
                'warning'
              );

            $('input[name=mname]').addClass('error');
            return false;
        }
        else if(/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test($('input[name=mname]').val()))
        {
            Swal.fire(
                'Warning',
                'Special characters are not allowed.',
                'warning'
              );

              $('input[name=mname]').addClass('error');
              return false;
        }
        else
        {
            $('input[name=mname]').removeClass('error');
            return true;
        }
    }

    createDom()
    {
        return $.ajax({
            type        :   'POST',
            url         :   'get-tree',
            success     :   responce => $('#tree').html(responce),
            error       :   (xhr,err)=> Swal.fire('Opps!','Somthing went wrong','error')
        });
        // this.getRecords(records =>
        // {
        //     var ar = [];
        //     records.forEach(rc =>ar[rc.id] = {name    : rc.Name,parent  : rc.ParentId});

        //     this.createView(ar,0);
        //     console.log(this.tree);
        //     console.log(ar);
        //     $('#tree').html(this.tree);
        // });

    }

    async createView(arr,parent,level = 0,prelevel = -1)
    {
        await arr.forEach((data,id)=>
        {
                  
            if(parent == data.parent)
            {
                if(level > prelevel)
                    this.tree += '<ol>';
                
                if(level == prelevel)
                    this.tree += '</li>';

                this.tree += '<li>'+data.name;

                if(level > prelevel)
                    prelevel=level;
            
                level++;
                this.createView(arr,id,level,prelevel);
                level--;
            }
        });

        if(level == prelevel)
            this.tree += '</li></ol>';
    }

    submit()
    {
        $.ajax({
            type        :   'POST',
            url         :   'insert-records',
            data        :   {
                                parent  :   $('select[name=parent]').val(),
                                mname   :   $('input[name=mname]').val(),
                            },
            success     :   responce =>
                            {
                                if(responce['status'] !== undefined && responce.status === true)
                                {
                                    Swal.fire('Success!','Data saved successfully.','success')
                                    .then(()=> $('#staticBackdrop').modal('hide'));

                                    this.setParent();
                                    this.createDom();


                                }
                                else Swal.fire('Opps!','Data saving was unsuccessful.','error')
                            },
            error       :   (xhr,err)=> Swal.fire('Opps!','Somthing went wrong','error')
        });
    }
}

$(()=>
{
    const obj =new app();

    obj.setParent();
    obj.createDom();

    $('#addBtn').click(()=>(obj.validateForm() === true) ? obj.submit() : '');



    $('button.addmember').click(()=>
    {
        $('select[name=parent]').val('0')
        $('input[name=mname]').val('')
    });
});